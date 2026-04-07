===source===
<?php ${$obj->name} = 'x';
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
                  "VariableVariable": {
                    "kind": {
                      "PropertyAccess": {
                        "object": {
                          "kind": {
                            "Variable": "obj"
                          },
                          "span": {
                            "start": 8,
                            "end": 12
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "name"
                          },
                          "span": {
                            "start": 14,
                            "end": 18
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 8,
                      "end": 18
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "x"
                },
                "span": {
                  "start": 22,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
