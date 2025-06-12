<?php
$id = $_GET['booked-doctor'] ?? 0;
$query = "SELECT * FROM doctor WHERE id = $id";
$result = mysqli_query($conn, $query);
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <?php if (isset($_SESSION['appointment_error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['appointment_error'];
                unset($_SESSION['appointment_error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['appointment_success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['appointment_success'];
                unset($_SESSION['appointment_success']); ?>
            </div>
        <?php endif; ?>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                    <?php if (!empty($row['avatar'])): ?>
                        <img src="./server/uploads/<?= $row['avatar'] ?>" class="card-img-top" style="height: 300px; object-fit: cover;" alt="Doctor Image">
                    <?php endif; ?>

                    <div class="card-body p-4">
                        <h3 class="card-title text-primary"><?= htmlspecialchars($row['name']) ?></h3>
                        <p class="mb-1"><strong>Qualification:</strong> <?= htmlspecialchars($row['qualification']) ?></p>
                        <p class="mb-1"><strong>Fees:</strong> ₹<?= number_format($row['fees'], 2) ?></p>
                        <p class="mb-1"><strong>Available:</strong> <?= htmlspecialchars($row['times']) ?></p>
                        <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                        <p class="mb-3"><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>

                        <p class="text-muted">
                            <strong>About me:</strong><br>
                            <?= nl2br(htmlspecialchars($row['about'])) ?>
                        </p>

                        <form action="server/request.php" method="POST" id="bookingForm">
                            <!-- Hidden inputs -->
                            <input type="hidden" name="doctor_id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="selected_day" id="selected_day">
                            <input type="hidden" name="selected_slot" id="selected_slot">

                            <!-- Day Selection -->
                            <h6 class="mt-4 text-secondary">Select a Day:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <?php
                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                foreach ($days as $day): ?>
                                    <button type="button" class="btn btn-outline-primary btn-sm day-btn" data-day="<?= $day ?>"><?= $day ?></button>
                                <?php endforeach; ?>
                            </div>

                            <!-- Time Slot Selection -->
                            <h6 class="mt-4 text-secondary">Select Time Slot:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <?php
                                $slots = ['10AM - 12PM', '12PM - 2PM', '2PM - 4PM', '4PM - 6PM'];
                                foreach ($slots as $slot): ?>
                                    <button type="button" class="btn btn-outline-success btn-sm slot-btn" data-slot="<?= $slot ?>"><?= $slot ?></button>
                                <?php endforeach; ?>
                            </div>

                            <!-- Book Now -->
                            <div class="mt-4">
                                <button type="submit" name="book_appointment" class="btn btn-warning w-100">
                                    Book Appointment
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- JavaScript to handle selection -->
<script>
    const dayButtons = document.querySelectorAll('.day-btn');
    const slotButtons = document.querySelectorAll('.slot-btn');
    const selectedDay = document.getElementById('selected_day');
    const selectedSlot = document.getElementById('selected_slot');

    dayButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            selectedDay.value = btn.getAttribute('data-day');
            dayButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    slotButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            selectedSlot.value = btn.getAttribute('data-slot');
            slotButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
</script>