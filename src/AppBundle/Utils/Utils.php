<?php

namespace AppBundle\Utils;


class Utils {
    /**
     * Get the Username from the email.
     *
     * @param string $email The User email
     * @return string
     */
    public function emailToUsername($email)
    {
        $array = explode("@", $email);
        return $array[0];
    }

    /**
     * Get MD5 hash of the User email for activation.
     *
     * @return string
     */
    public function randomMd5()
    {
        $hash = md5(uniqid(rand(), true));
        return $hash;
    }

    /**
     * Convert CI number to Birth Date
     *
     * @param string $ci The Student CI number
     * @return \DateTime
     */
    public function ciToBirthDate($ci)
    {
        $year = $ci[0] . $ci[1];
        $month = $ci[2] . $ci[3];
        $day = $ci[4] . $ci[5];
        $date = $year . "-" . $month . "-" . $day;

        return new \DateTime($date);
    }

    /**
     * Convert CI number to Sex
     *
     * @param string $ci The Student CI number
     * @return boolean
     */
    public function ciToSex($ci)
    {
        $sex = (int)$ci[9];
        return $sex % 2 == 0 ? true : false;
    }
} 