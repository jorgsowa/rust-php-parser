===source===
<?php switch { }
===errors <=7.4===
expected '(', found '{'
missing closing ')'
===errors >=8.0===
expected '(', found '{'
Array and string offset access syntax with curly braces is no longer supported
missing closing ')'
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
                    "start": 12,
                    "end": 12
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 12,
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
