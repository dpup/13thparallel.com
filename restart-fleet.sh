ip=`curl "http://pupius.co.uk/ip.php"`
echo "Restarting services via $ip"
fleetctl --tunnel $ip destroy 13thparallel*
fleetctl --tunnel $ip start 13thparallel*
fleetctl --tunnel $ip list-units
