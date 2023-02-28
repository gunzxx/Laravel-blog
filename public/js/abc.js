// Abjad
const abc = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-!';
abjad = abc.split('');

function cekHurufkata(katas){
    let kata2 ='';
    let sample = katas.split("");
    let dump2 = [];
    sample.forEach(e => {
        if(abjad.includes(e)){
            dump2.push(e)
        }
        else{
            dump2.push("");
        }
    });
    kata2 = dump2.join("");
    return kata2;
}