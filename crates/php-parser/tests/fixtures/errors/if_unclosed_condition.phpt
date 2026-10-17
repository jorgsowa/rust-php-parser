===source===
<?php if ( { }
===errors===
expected expression
Array and string offset access syntax with curly braces is no longer supported
expected ')' to close the delimiter opened at byte 9
expected statement
===php_error===
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
                    "start": 11,
                    "end": 12
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 11,
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
