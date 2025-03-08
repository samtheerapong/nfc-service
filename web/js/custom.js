$(document).on('click', '.approve-btn', function () {
    var button = $(this);
    var index = button.data('index');
    var row = button.closest('tr'); // หาข้อมูลในแถวที่ถูกต้อง
    var statusInput = row.find("input[name='OrderItem[" + index + "][status_id]']");

    // Toggle the status_id and button state
    if (button.attr('data-status') == 1) {
        // Change to approved state
        statusInput.val(2); // Set status_id to 2
        button.removeClass('btn-outline-danger').addClass('btn-success')
            .html('<i class="fa-solid fa-square-check"></i> อนุมัติแล้ว'); // ใช้ html() เพื่อให้แสดงไอคอน
        button.attr('data-status', 2); // Update the button's status
    } else {
        // Change to waiting for approval state
        statusInput.val(1); // Set status_id to 1
        button.removeClass('btn-success').addClass('btn-outline-danger')
            .html('<i class="fa-solid fa-spinner"></i> รออนุมัติ'); // ใช้ html() เพื่อให้แสดงไอคอน
        button.attr('data-status', 1); // Update the button's status
    }
});

document.getElementById('btn-save').addEventListener('click', function (event) {
    event.preventDefault(); // ป้องกันการส่งฟอร์มทันที

    Swal.fire({
        title: 'ยืนยันการบันทึก?',
        text: 'คุณต้องการบันทึกข้อมูลนี้หรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, บันทึก!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            document.forms[0].submit(); // ส่งฟอร์มเมื่อกด "ใช่"
        }
    });
});