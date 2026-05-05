===config===
min_php=8.1
===source===
<?php enum Status { #[Attr1] #[Attr2('value')] const X = 1; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "X",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 57,
                      "end": 58
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attr1"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 27
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 27
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "Attr2"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 31,
                          "end": 36
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "String": "value"
                            },
                            "span": {
                              "start": 37,
                              "end": 44
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 37,
                            "end": 44
                          }
                        }
                      ],
                      "span": {
                        "start": 31,
                        "end": 45
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 47,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
