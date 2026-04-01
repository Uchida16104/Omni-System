import sys
try:
    sys.stdout.write('{"status":"active","vector":"environmental_anomaly_detection"}')
except Exception:
    sys.stdout.write('{"status":"fallback","vector":"safe_mode_activated"}')
