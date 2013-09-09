<?php
namespace Edlcdmc\Bundle\CommonBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Kammag\Common\Component\Form\DataTransformer\ObjectToIdTransformer;

class HiddenObjectType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new ObjectToIdTransformer($this->om, $options['repositoryName']);
        $builder->addModelTransformer($transformer);

    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
//        echo "_CCCC_";

//        for($i = $this->start; $i <= $this->end; $i++) $arr[$i] = $i;
//        $resolver->setOptional(array('start', 'end'));
//        print_r($start);
        $repositoryName = function (Options $options) {
            return $options['repositoryName'];
        };
//        print_r($arr);
        $resolver->setDefaults(array(
            'invalid_message' => 'The selected issue does not exist',
 			'repositoryName' => $repositoryName,
		));
	}

	public function getParent()
	{
 		return 'text';
	}

	public function getName()
	{
		return 'hidden_object';
	}
}
