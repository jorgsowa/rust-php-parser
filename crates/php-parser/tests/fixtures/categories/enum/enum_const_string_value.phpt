===config===
min_php=8.1
===source===
<?php enum Status { const PREFIX = 'status_'; }
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
                  "name": "PREFIX",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "String": "status_"
                    },
                    "span": {
                      "start": 35,
                      "end": 44
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
