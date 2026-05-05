===config===
min_php=8.1
===source===
<?php enum Status { /** Doc for constant */ const VALUE = 1; }
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
                  "name": "VALUE",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 58,
                      "end": 59
                    }
                  },
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** Doc for constant */",
                    "span": {
                      "start": 20,
                      "end": 43
                    }
                  }
                }
              },
              "span": {
                "start": 44,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
