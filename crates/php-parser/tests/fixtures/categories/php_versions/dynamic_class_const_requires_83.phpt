===source===
<?php
$x = Foo::{$name};
===errors 8.2===
'dynamic class constant fetch' requires PHP 8.3 or higher
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "(" in Standard input code on line 2
===ast 8.2===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccessDynamic": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 11,
                            "end": 14
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 14
                      }
                    },
                    "member": {
                      "kind": {
                        "Variable": "name"
                      },
                      "span": {
                        "start": 17,
                        "end": 22
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
