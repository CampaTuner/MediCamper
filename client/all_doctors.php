<?php
$query = "SELECT * FROM doctor";
$result = mysqli_query($conn, $query);

$height = isset($_SESSION['isAdmin']) ? "600px" : "500px"

?>
<div class="container py-5">
    <h2 class="text-center text-primary mb-4">Registered Doctors</h2>

    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4" style="height : <?php echo $height?>">
                    <?php if (!empty($row['avatar'])): ?>
                        <img src="./server/uploads/<?= $row['avatar'] ?>" class="card-img-top rounded-top-4" style="height:250px; object-fit:cover;" alt="Doctor Image">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?= htmlspecialchars($row['name']) ?></h5>
                        <p class="card-text">
                            <strong>Qualification:</strong> <?= htmlspecialchars($row['qualification']) ?><br>
                            <strong>Fees:</strong> ₹<?= number_format($row['fees'], 2) ?><br>
                            <strong>Available:</strong> <?= htmlspecialchars($row['times']) ?><br>
                            <strong>Email:</strong> <?= htmlspecialchars($row['email']) ?><br>
                            <strong>Location:</strong> <?= htmlspecialchars($row['location']) ?><br>
                        </p>
                        <?php if (isset($_SESSION['isAdmin'])): ?>
                            <p class="small text-muted">
                                <strong style="text-decoration: underline;">About me:</strong>
                                <?= nl2br(htmlspecialchars($row['about'])) ?>
                            </p>
                        <?php else: ?>
                            <a href="?booked-doctor=<?php echo $row['id']?>" class="btn btn-primary me-2">Book Appointment</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>