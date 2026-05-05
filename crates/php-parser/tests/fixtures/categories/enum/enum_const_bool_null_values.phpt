===config===
min_php=8.1
===source===
<?php enum Status { const ENABLED = true; const DISABLED = false; const NOTHING = null; }
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
                  "name": "ENABLED",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 36,
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
                  "name": "DISABLED",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Bool": false
                    },
                    "span": {
                      "start": 59,
                      "end": 64
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 65
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "NOTHING",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 82,
                      "end": 86
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 66,
                "end": 87
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 89
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 89
  }
}
