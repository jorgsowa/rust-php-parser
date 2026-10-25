===source===
<?php
$a{}->b;
===errors <=8.3===
expected expression, found '}'
===errors >=8.4===
Array and string offset access syntax with curly braces is no longer supported
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}' in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "}" in Standard input code on line 2
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 6,
                        "end": 8
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 12,
                  "end": 13
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 13
          }
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
