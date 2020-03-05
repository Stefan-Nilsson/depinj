<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CapitalizeRepository")
 */
class Capitalize implements TransformInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $input;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInput(): ?string
    {
        return $this->input;
    }

    public function setInput(string $input): self
    {
        $this->input = $input;

        return $this;
    }
    public function transform($input)
    {
        $this->allTogetherNow($input);
    }

    public function upperForEveryOtherLetter($input)
    {
        for ($i = 0; count($input); $i = $i +2){
            strtoupper($input[$i]);
        }
    }

    public function allToLower($input)
    {
        foreach($input as $letter){
            strtolower($letter);
        }

    }

    public function toSingleLetters($input)
    {
        return [preg_split('//u', $input, null, PREG_SPLIT_NO_EMPTY)];
    }

    public function allTogetherNow($input)
    {
        $singleLetterArray = [];
        $singleLetterArray = $this->toSingleLetters($input);
        $singleLetterArrayLowerCase = [];
        $singleLetterArrayLowerCase = $this->allToLower($singleLetterArray);

       return $this->upperForEveryOtherLetter($singleLetterArrayLowerCase);
    }
}

