===source===
<?php switch { }
===errors <=7.4===
expected '(', found '{'
expected expression
expected ')' to close the delimiter opened at byte 13
expected '{', found end of file
expected '}', found end of file
===errors >=8.0===
expected '(', found '{'
expected expression
Array and string offset access syntax with curly braces is no longer supported
expected ')' to close the delimiter opened at byte 13
expected '{', found end of file
expected '}', found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting '(' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "{", expecting "(" in Standard input code on line 1
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
