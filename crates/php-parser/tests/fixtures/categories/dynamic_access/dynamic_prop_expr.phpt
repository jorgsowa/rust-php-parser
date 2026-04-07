===source===
<?php $obj->{$prefix . 'Name'};
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
                  "Variable": "obj"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "property": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "prefix"
                      },
                      "span": {
                        "start": 13,
                        "end": 20
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "Name"
                      },
                      "span": {
                        "start": 23,
                        "end": 29
                      }
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
