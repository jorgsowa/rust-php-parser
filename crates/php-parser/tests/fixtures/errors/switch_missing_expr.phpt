===source===
<?php switch { }
===errors===
expected '(', found '{'
expected expression
unclosed '')'' opened at Span { start: 13, end: 14 }
expected '{', found end of file
expected '}', found end of file
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": "Error",
                  "span": {
                    "start": 13,
                    "end": 14
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 13,
              "end": 16
            }
          },
          "cases": []
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "{", expecting "(" in Standard input code on line 1
