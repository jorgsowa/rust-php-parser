===config===
min_php=8.1
===source===
<?php enum Numbers { const PI = 3.14; const TAU = 6.28; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Numbers",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "PI",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Float": 3.14
                    },
                    "span": {
                      "start": 32,
                      "end": 36
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 37
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "TAU",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Float": 6.28
                    },
                    "span": {
                      "start": 50,
                      "end": 54
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 38,
                "end": 55
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
