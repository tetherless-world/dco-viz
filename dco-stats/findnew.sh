#!/bin/sh

statsdir=$1
if [ "$statsdir" = "" ]
then
    echo "Usage: $0 <statsdir>"
    exit 1
fi

if [ ! -d $statsdir ]
then
    echo "Directory \"$statsdir\" does not exist"
    echo "Usage: $0 <statsdir>"
    exit 1
fi

cd $statsdir
outfile="newinstances"
echo "" > $outfile
for i in ds fs instr person proj pu pub
do
    script="${i}Stats.py"
    echo $script
    python3 $script --base=$statsdir >> $outfile
done

echo "drupal users"
python3 drupalUsers.py >> $outfile
echo "" >> $outfile

echo "vivo users"
python3 vivoUsers.py >> $outfile
echo "" >> $outfile

mailx -s "NewObjs on deepcarbon" westp@rpi.edu < ${outfile}
