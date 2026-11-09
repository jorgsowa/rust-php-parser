===source===
<?php
echo $a{0}::C;
===errors >=8.0===
Array and string offset access syntax with curly braces is no longer supported
===php_error 8.0-8.3===
PHP Fatal error:  Array and string offset access syntax with curly braces is no longer supported in Standard input code on line 2
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 11,
                          "end": 13
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 14,
                          "end": 15
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 16
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "C"
                  },
                  "span": {
                    "start": 18,
                    "end": 19
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 19
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
