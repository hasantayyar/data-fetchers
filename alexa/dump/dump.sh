mongo localhost/alexa --quiet --eval "db.site.find({}, {_id:0}).forEach(printjson);" > site.json
