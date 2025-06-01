#!/bin/bash

echo "[*] Starting MARSLOG Appliance installation (No Kibana)..."

# STEP 1: เตรียม log folder
mkdir -p /var/log/marslog
chown -R $USER:$USER /var/log/marslog

# STEP 2: สร้าง Docker network
docker network create marslog-net || true

# STEP 3: ตรวจสอบ docker-compose.yml
if [ ! -f docker-compose.yml ]; then
  echo "[✗] ไม่พบไฟล์ docker-compose.yml"
  exit 1
fi

# STEP 4: ติดตั้ง ELK (ไม่มี Kibana) + API + UI + Agent + Alert + NGINX
docker-compose pull
docker-compose up -d

# STEP 5: ติดตั้ง cron สำหรับ License Checker
cron_entry="@reboot root $(pwd)/license-check/check.sh"
(crontab -l 2>/dev/null | grep -Fv "$cron_entry" ; echo "$cron_entry") | crontab -

# STEP 6: แสดงสถานะ container ทั้งหมด
echo
echo "[*] Docker containers running:"
docker ps

# STEP 7: แสดงผลลัพธ์
echo
echo "[✓] MARSLOG Appliance deployed successfully (No Kibana)."
echo "[✓] Access Web UI at: http://192.168.100.100:8885"
