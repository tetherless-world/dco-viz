#!/bin/sh

cd /opt/backups/stats
outfile="/opt/backups/stats/newinstances"
echo "" > $outfile
for i in ds fs instr person proj pu pub
do
    script="${i}Stats.py"
    python3 $script >> $outfile
done

python3 drupalUsers.py >> $outfile

python3 vivoUsers.py >> $outfile

mailx -s "NewObjs on deepcarbon" westp@rpi.edu < ${outfile}
