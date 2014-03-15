mongo localhost/alexa --quiet --eval 'db.site.find({"country":"Turkey"}, {_id:0}).forEach(printjson);' > site_turkey.json
