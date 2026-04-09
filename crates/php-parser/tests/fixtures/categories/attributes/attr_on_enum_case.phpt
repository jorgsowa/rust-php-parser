===config===
min_php=8.1
===source===
<?php enum Suit { #[Description('Hearts')] case Hearts; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Suit",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Hearts",
                  "value": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Description"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 20,
                          "end": 31
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "String": "Hearts"
                            },
                            "span": {
                              "start": 32,
                              "end": 40
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 32,
                            "end": 40
                          }
                        }
                      ],
                      "span": {
                        "start": 20,
                        "end": 41
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 43,
                "end": 56
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
