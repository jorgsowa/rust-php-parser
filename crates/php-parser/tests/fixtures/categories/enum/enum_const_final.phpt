===config===
min_php=8.1
===source===
<?php enum Status { final const X = 1; final public const Y = 2; }
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
                  "is_final": true,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 38
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "Y",
                  "visibility": "Public",
                  "is_final": true,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 62,
                      "end": 63
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 39,
                "end": 64
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
