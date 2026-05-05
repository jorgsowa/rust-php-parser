===config===
min_php=8.1
===source===
<?php enum Status { #[SomeAttr] const X = 1; }
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
                      "start": 42,
                      "end": 43
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "SomeAttr"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 30
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 30
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 32,
                "end": 44
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
