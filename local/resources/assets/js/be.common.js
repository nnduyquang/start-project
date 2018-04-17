integratedCKEDITOR('description-page',height=200);
// integratedCKEDITOR('seo-description',height=200);
if ($('#btnBrowseImage').length) {
    var button1 = document.getElementById('btnBrowseImage');
    button1.onclick = function () {
        selectFileWithKCFinder('pathImage','showHinh');
    }
}

$('.ulti-copy').click(function(){
    var selected = [];
    $('input[type=checkbox][name=id\\[\\]]').each(function() {
        if ($(this).is(":checked")) {
            selected.push($(this).val());
        }
    });
    if(selected.length!=0)
    {
        $('input[name=listID]').val(selected);
        alert('Đã lưu sản phẩm');
    }
    else{
        alert('Mời bạn chọn sản phẩm');
    }
    console.log(selected);
    // alert(id[0]);
});
$('.ulti-paste').click(function(){
    if( !$('input[name=listID]').val()){
        alert('Bạn chưa Sao Chép Hoặc Chưa chọn sản phẩm');
    }
    else{
        $('#formPaste').submit();
    }
});