<?php

class HitChecker {

	private const X_MIN = -4;
    private const X_MAX = 4;
    private const Y_MIN = -3;
    private const Y_MAX = 3;
    private const R_MIN = 1;
    private const R_MAX = 5;

	public function validate($x, $y, $r) {
        if (!is_numeric($x) || !is_numeric($y) || !is_numeric($r)) {
            return false;
        } else {

            if (!($x >= self::X_MIN && $x <= self::X_MAX)) {
                return false;
            }
    
            if (!($y >= self::Y_MIN && $y <= self::Y_MAX)) {
                return false;
            }
    
            if (!($r >= self::R_MIN && $r <= self::R_MAX)) {
                return false;
            }

            return true;
        }
    }

	public function checkTriangle($x, $y, $r) {
		if ($x <= 0 && $y >= 0) {
			if (($x + $r / 2) >= $y) // y = x + r / 2;
				return true;
			else
				return false;
		}
	}

	public function checkCircle($x, $y, $r) {
		if ($x < 0 || $x > $r / 2 || $y < 0 || $y > $r / 2) {
			return false;
		} elseif (($x * $x + $y * $y) <= $r * $r) {
			return true;
		} else {
			return false;
		}
	}

	public function checkRectangle($x, $y, $r) {
		if ($x <= 0 && $y <= 0) {
			if ($x >= -$r && $y >= -$r / 2)
				return true;
			else
				return false;
		}
	}

	public function checkHit($x, $y, $r) {
		return $this->checkTriangle($x, $y, $r) || $this->checkCircle($x, $y, $r) || $this->checkRectangle($x, $y, $r);
	}
}
?>
