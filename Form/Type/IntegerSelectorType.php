<?php
namespace Edlcdmc\Bundle\CommonBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;

class IntegerSelectorType extends AbstractType
{

    private $start = 1;
    private $end = 10;
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        echo "AAAAAAA_".$options['start'];
//        $this->start = $options['start'];
//        $arr = array();
//        for($i = 2; $i <= 8; $i++) $arr[$i] = $i;
//        $options['choices'] =  $arr;

//        if(isset($options['start'])) $this->start = $options['start'];
//        if(isset($options['end'])) $this->end = $options['end'];
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
//        echo "_CCCC_";

        for($i = $this->start; $i <= $this->end; $i++) $arr[$i] = $i;
//        $resolver->setOptional(array('start', 'end'));
//        print_r($start);
        $arr = function (Options $options) {
            $arr = array();
            for($i = $options['start']; $i <= $options['end']; $i++) $arr[$i] = $i;
            return $arr;
        };
//        print_r($arr);
        $resolver->setDefaults(array(
            'invalid_message' => 'The selected issue does not exist',
 				'choices' => $arr,
                'start' => 0,
                'end' => -1,
		));
	}

	public function getParent()
	{
 		return 'choice';
	}

	public function getName()
	{
		return 'integerSelector';
	}
}
