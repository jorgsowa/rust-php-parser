===config===
min_php=8.2
max_php=8.2
===source===
<?php
$x = Foo::{$name};
===errors===
'dynamic class constant fetch' requires PHP 8.3 or higher (targeting PHP 8.2)
===ast===
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
                        "Identifier": "Foo"
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
