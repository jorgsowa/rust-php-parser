===source===
<?php enum Status { const PREFIX = 'status_'; }
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 1
===ast >=8.1===
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
                    "name": "PREFIX",
                    "span": {
                      "start": 26,
                      "end": 32
                    }
                  },
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
