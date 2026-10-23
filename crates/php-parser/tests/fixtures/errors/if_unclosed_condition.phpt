===source===
<?php if ( { }
===errors <=7.4===
expected expression, found '{'
missing closing ')'
expected statement, found end of file
===errors >=8.0===
expected expression, found '{'
Array and string offset access syntax with curly braces is no longer supported
missing closing ')'
expected statement, found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 1
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
                    "start": 10,
                    "end": 10
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 10,
              "end": 14
            }
          },
          "then_branch": {
            "kind": "Error",
            "span": {
              "start": 14,
              "end": 14
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
