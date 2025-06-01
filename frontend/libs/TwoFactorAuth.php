<?php
class TwoFactorAuth {
    protected $issuer;
    public function __construct($issuer = null) {
        $this->issuer = $issuer;
    }
    public function verifyCode($secret, $code, $discrepancy = 1, $currentTimeSlice = null) {
        $currentTimeSlice = $currentTimeSlice ?: floor(time() / 30);
        for ($i = -$discrepancy; $i <= $discrepancy; ++$i) {
            if ($this->getCode($secret, $currentTimeSlice + $i) == $code) return true;
        }
        return false;
    }
    public function getCode($secret, $timeSlice = null) {
        $secretkey = $this->base32Decode($secret);
        $time = chr(0).chr(0).chr(0).chr(0).pack('N*', $timeSlice ?: floor(time() / 30));
        $hm = hash_hmac('sha1', $time, $secretkey, true);
        $offset = ord(substr($hm, -1)) & 0x0F;
        $hashpart = substr($hm, $offset, 4);
        $value = unpack("N", $hashpart)[1] & 0x7FFFFFFF;
        return str_pad($value % pow(10, 6), 6, '0', STR_PAD_LEFT);
    }
    protected function base32Decode($s) {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $s = strtoupper($s);
        $s = preg_replace('/[^A-Z2-7]/', '', $s);
        $binary = '';
        foreach (str_split($s) as $char) {
            $binary .= str_pad(decbin(strpos($alphabet, $char)), 5, '0', STR_PAD_LEFT);
        }
        $result = '';
        foreach (str_split($binary, 8) as $byte) {
            if (strlen($byte) === 8) $result .= chr(bindec($byte));
        }
        return $result;
    }
}
