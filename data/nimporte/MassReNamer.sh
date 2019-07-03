#! /bin/bash

if (test $# -ne 1) then
echo "Nombre de parametres incorrect: $# (1 attendus)"
echo "Usage : $0 <nom a donner aux fichiers>"
exit 1
fi

nom="$1"
i=0

for image in `ls *.jpg *.jpeg *.JPG *.png`
do
	ee=$(echo $image | grep -Eo "\..+$")
	echo "$image -> $nom$i$ee"
	cp $image "$nom$i.png"
	rm $image
	((i++))
done
