===config===
parse_version=8.5
min_php=8.5
===source===
<?php (void)[1, 2, 3];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 13,
                          "end": 14
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 13,
                        "end": 14
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 16,
                          "end": 17
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 16,
                        "end": 17
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 19,
                          "end": 20
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 19,
                        "end": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 12,
                  "end": 21
                }
              }
            ]
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
