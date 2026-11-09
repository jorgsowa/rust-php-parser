===source===
<?php
$o->{'1' + 1}();
===errors===
Method name must be a string
===php_error===
PHP Fatal error:  Method name must be a string in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "method": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "String": "1"
                      },
                      "span": {
                        "start": 11,
                        "end": 14
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 17,
                        "end": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 18
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
