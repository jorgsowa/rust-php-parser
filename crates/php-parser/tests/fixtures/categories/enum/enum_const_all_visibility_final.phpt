===config===
min_php=8.1
===source===
<?php enum Status { public final const PUB_FIN = 1; protected final const PROT_FIN = 2; private final const PRIV_FIN = 3; }
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
                  "name": "PUB_FIN",
                  "visibility": "Public",
                  "is_final": true,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 49,
                      "end": 50
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 51
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "PROT_FIN",
                  "visibility": "Protected",
                  "is_final": true,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 85,
                      "end": 86
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 52,
                "end": 87
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "PRIV_FIN",
                  "visibility": "Private",
                  "is_final": true,
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 119,
                      "end": 120
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 88,
                "end": 121
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 123
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 123
  }
}
