===config===
min_php=8.1
===source===
<?php enum Status { protected final const PROT = 1; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "PROT",
                    "span": {
                      "start": 42,
                      "end": 46
                    }
                  },
                  "visibility": "Protected",
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
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
