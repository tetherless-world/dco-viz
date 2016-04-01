#!/bin/sh

workdir=/opt/backups/stats
if [ "$1" != "" ]
then
    workdir=$1
fi

outfile="${workdir}/newinstances"
echo "" > $outfile
scriptdir=`dirname $0`
for i in ds fs instr person proj pu pub
do
    script="${scriptdir}/${i}Stats.py"
    python3 ${script} --base $workdir >> $outfile
done

script="${scriptdir}/drupalUsers.py"
python3 $script >> $outfile

script="${scriptdir}/vivoUsers.py"
python3 $script >> $outfile

mailx -s "NewObjs on deepcarbon" westp@rpi.edu < ${outfile}
