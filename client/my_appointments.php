<?php
$p_id = $_SESSION['p_id'] ?? 0;

// Query to get appointment with doctor details
$query = "
    SELECT 
        appointment.id AS appointment_id,
        appointment.day,
        appointment.slot,
        doctor.name AS doctor_name,
        doctor.avatar,
        doctor.qualification,
        doctor.email,
        doctor.location,
        doctor.fees
    FROM appointment
    JOIN doctor ON appointment.d_id = doctor.id
    WHERE appointment.p_id = $p_id
    ORDER BY appointment.id DESC
";
$result = mysqli_query($conn, $query);
?>

<div class="container py-5">
    <h2 class="text-center text-primary mb-4">My Appointments</h2>

    <?php if (mysqli_num_rows($result) === 0): ?>
        <div class="alert alert-info text-center">You have no appointments yet.</div>
    <?php endif; ?>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="card mb-4 shadow-sm border-0 rounded-4" style="height: 280px; background-color:#d5dbe0">
            <div class="row g-0">
                <!-- Doctor Image -->
                <div class="col-md-4">
                    <?php if (!empty($row['avatar'])): ?>
                        <img src="./server/uploads/<?= htmlspecialchars($row['avatar']) ?>" class="img-fluid rounded-start " style="object-fit: cover;height:280px; width:300px" alt="Doctor Image">
                    <?php else: ?>
                        <div class="bg-light d-flex align-items-center justify-content-center h-100">
                            <span class="text-muted">No Image</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Appointment & Doctor Info -->
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?= htmlspecialchars($row['doctor_name']) ?></h5>
                        <p class="mb-1"><strong>Qualification:</strong> <?= htmlspecialchars($row['qualification']) ?></p>
                        <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                        <p class="mb-1"><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
                        <p class="mb-1"><strong>Fees:</strong> ₹<?= number_format($row['fees'], 2) ?></p>
                        <hr>
                        <p class="mb-1"><strong>Day:</strong> <?= htmlspecialchars($row['day']) ?></p>
                        <p class="mb-1"><strong>Time Slot:</strong> <?= htmlspecialchars($row['slot']) ?></p>

        
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
