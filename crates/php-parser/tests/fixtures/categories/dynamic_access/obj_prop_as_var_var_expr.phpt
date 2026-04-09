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
                            "end": 12,
                            "start_line": 1,
                            "start_col": 8
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "name"
                          },
                          "span": {
                            "start": 14,
                            "end": 18,
                            "start_line": 1,
                            "start_col": 14
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 8,
                      "end": 18,
                      "start_line": 1,
                      "start_col": 8
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "x"
                },
                "span": {
                  "start": 22,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26,
    "start_line": 1,
    "start_col": 0
  }
}
