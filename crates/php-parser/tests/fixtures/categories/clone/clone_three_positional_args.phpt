===config===
min_php=8.5
===source===
<?php clone($x, $y, $z);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "clone"
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 12,
                      "end": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 12,
                    "end": 14
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "y"
                    },
                    "span": {
                      "start": 16,
                      "end": 18
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 16,
                    "end": 18
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "z"
                    },
                    "span": {
                      "start": 20,
                      "end": 22
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 20,
                    "end": 22
                  }
                }
              ]
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
