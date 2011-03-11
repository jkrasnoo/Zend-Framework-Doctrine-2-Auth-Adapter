<?php
namespace BadWolf\Doctrine\Orm\Query\Ast\Functions;
use Doctrine\ORM\Query\Lexer,
    Doctrine\ORM\Query\AST\Functions\FunctionNode;
/**
 *
 */
class Sha2Function extends FunctionNode
{
    public $stringPrimary;
    public $firstSimpleArithmeticExpression;

    /**
     * @override
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'SHA2('
             . $sqlWalker->walkStringPrimary($this->stringPrimary)
             . ','
             . $sqlWalker->walkSimpleArithmeticExpression($this->firstSimpleArithmeticExpression)
             . ')';
    }

    /**
     * @override
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->stringPrimary = $parser->StringPrimary();

        $parser->match(Lexer::T_COMMA);

        $this->firstSimpleArithmeticExpression = $parser->SimpleArithmeticExpression();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}