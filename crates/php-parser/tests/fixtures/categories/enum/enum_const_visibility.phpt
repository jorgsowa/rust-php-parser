===config===
min_php=8.1
===source===
<?php enum Status { public const PUB = 1; protected const PROT = 2; private const PRIV = 3; }
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
                  "name": "PUB",
                  "visibility": "Public",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 41
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "PROT",
                  "visibility": "Protected",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 65,
                      "end": 66
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 67
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "PRIV",
                  "visibility": "Private",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 89,
                      "end": 90
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 68,
                "end": 91
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 93
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93
  }
}
