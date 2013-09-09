<?php
namespace Edlcdmc\Bundle\CommonBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class ObjectToIdTransformer implements DataTransformerInterface
{
	/**
	 * @var ObjectManager
	 */
	private $om;

    /**
     * @var  string repositoryName
     */
    private $repositoryName;

    /**
	 * @param ObjectManager $om
	 */
	public function __construct(ObjectManager $om, $repositoryName)
	{
		$this->om = $om;
        $this->repositoryName = $repositoryName;
	}

	/**
	 * Transforms an object (issue) to a string (number).
	 *
	 * @param  Issue|null $issue
	 * @return string
	 */
	public function transform($issue)
	{
		if (null === $issue) {
			return "";
		}

		return $issue->getId();
	}

	/**
	 * Transforms a string (number) to an object (issue).
	 *
	 * @param  string $number
	 * @return Issue|null
	 * @throws TransformationFailedException if object (issue) is not found.
	 */
	public function reverseTransform($id)
	{
		if (!$id) {
			return null;
		}

		$issue = $this->om->getRepository($this->repositoryName)->findOneBy(array('id' => $id));

		if (null === $issue) {
			throw new TransformationFailedException(sprintf(
					'An issue with id "%s" does not exist!',
					$id
			));
		}

		return $issue;
	}
}
