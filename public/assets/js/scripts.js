<script>
    
</script>

// Konfirmasi sebelum menghapus data
document.addEventListener("DOMContentLoaded", function() {
    let deleteButtons = document.querySelectorAll(".btn-danger");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            if (!confirm("Yakin ingin menghapus data ini?")) {
                event.preventDefault();
            }
        });
    });
});

// Notifikasi otomatis hilang setelah beberapa detik
setTimeout(() => {
    let alertMessages = document.querySelectorAll(".alert");
    alertMessages.forEach(alert => {
        alert.style.transition = "opacity 1s";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 1000);
    });
}, 3000);


function confirmLogout(event) {
    event.preventDefault(); // Mencegah logout langsung

    let confirmAction = confirm("Apakah Anda yakin ingin logout?");
    if (confirmAction) {
        window.location.href = event.target.href; // Redirect ke logout jika setuju
    }
}

document.getElementById("icd_code").addEventListener("keyup", function() {
    let query = this.value;

    if (query.length < 2) {
        document.getElementById("icd_suggestions").innerHTML = "";
        return;
    }

    console.log("Mengirim pencarian ICD:", query); // Debugging

    fetch("<?= base_url('icd/search'); ?>?query=" + query)
        .then(response => response.json())
        .then(data => {
            console.log("Hasil pencarian ICD:", data); // Debugging
            let suggestions = "";
            data.forEach(icd => {
                suggestions += `<li class="list-group-item icd-item" data-code="${icd.code}" data-description="${icd.description}">${icd.code} - ${icd.description}</li>`;
            });

            document.getElementById("icd_suggestions").innerHTML = suggestions;
        })
        .catch(error => console.error("Error:", error));
});

document.addEventListener("click", function(event) {
    if (event.target.classList.contains("icd-item")) {
        document.getElementById("icd_code").value = event.target.getAttribute("data-code");
        document.getElementById("icd_suggestions").innerHTML = "";
    }
});