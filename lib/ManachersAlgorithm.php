<?php
class ManachersAlgorithm {
    
    function findLongestPalindrome($s) {
        
        $s = $this->strToLowerWithoutSpaces($s);

        $s2 = preg_split('//u', $s, null, PREG_SPLIT_NO_EMPTY);
		$s2 = $this::addBoundaries($s2);
		$count = count($s2);
		$p;
        $c = 0; $r = 0; 
        $m = 0; $n = 0; 
        for ($i = 1; $i<$count; $i++) {
			
            if ($i>$r) {
                $p[$i] = 0; $m = $i-1; $n = $i+1;
            } else {
                $i2 = $c*2-$i;
                if (array_key_exists($i2, $p) && $p[$i2]<($r-$i)) {
                    $p[$i] = $p[$i2];
                    $m = -1; 
                } else {
                    $p[$i] = $r-$i;
                    $n = $r+1; $m = $i*2-$n;
                }
            }
            while ($m>=0 && $n<$count && $s2[$m]==$s2[$n]) {
                $p[$i]++; $m--; $n++;
            }
            if (($i+$p[$i])>$r) {
                $c = $i; $r = $i+$p[$i];
            }
        }
        $len = 0; $c = 0;
        for ($i = 1; $i<$count; $i++) {
            if ($len<$p[$i]) {
                $len = $p[$i]; $c = $i;
            }
        }
		$k = 0;
		$ss;
		for($j = $c-$len; $j < $c+$len+1; $j++)
		{
			$ss[$k] = $s2[$j];
			$k++;
		}
		
		$ss = $this::removeBoundaries($ss);
        return ($ss);
    }
 
    protected function addBoundaries($cs) {
        
		$strlen = count($cs)*2+1;
        $cs2;
        for ($i = 0; $i<($strlen-1); $i = $i+2) {
            $cs2[$i] = '|';
            $cs2[$i+1] = $cs[$i/2];
        }
        $cs2[$strlen-1] = '|';
        return $cs2;
    }

    protected function removeBoundaries($cs) {
        if ($cs==null || count($cs)<3)
           return str_split("");
		$strlen = (count($cs)-1)/2;
        $cs2;
        for ($i = 0; $i<$strlen; $i++) {
            $cs2[$i] = $cs[$i*2+1];
        }
        return implode('', $cs2);
    }    

    private function strToLowerWithoutSpaces($str)
    {
        return mb_strtolower(str_replace(" ","",$str));
    }
}