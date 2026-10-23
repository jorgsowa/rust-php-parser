===source===
<?php if { }
===errors <=7.4===
expected '(', found '{'
expected expression, found '{'
missing closing ')'
expected statement, found end of file
===errors >=8.0===
expected '(', found '{'
expected expression, found '{'
Array and string offset access syntax with curly braces is no longer supported
missing closing ')'
expected statement, found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting '(' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "{", expecting "(" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": "Error",
                  "span": {
                    "start": 8,
                    "end": 8
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 8,
              "end": 12
            }
          },
          "then_branch": {
            "kind": "Error",
            "span": {
              "start": 12,
              "end": 12
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12
  }
}
