function showSection(sectionID) {
    // Hide everything
    document.querySelectorAll('.content').forEach(s => s.style.display = 'none');
    document.getElementById('home').style.display = 'none';
    
    // Show active
    const active = document.getElementById(sectionID);
    if(active) {
        active.style.display = 'block';
    }
}

// Logo Click Requirement: Hides all 'content' class sections
function hideContent() {
    document.querySelectorAll('.content').forEach(s => s.style.display = 'none');
    document.getElementById('home').style.display = 'block';
}

// Clear Fields Requirement
function clearFields() {
    document.querySelectorAll('input').forEach(input => input.value = '');
}

// Toast logic
window.onload = function() {
    const params = new URLSearchParams(window.location.search);
    if (params.get('status') === 'success') {
        const toast = document.getElementById('success-toast');
        toast.style.display = 'block';
        setTimeout(() => { toast.style.display = 'none'; }, 3000);
    }
}
