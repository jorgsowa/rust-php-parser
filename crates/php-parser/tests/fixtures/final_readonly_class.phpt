===config===
min_php=8.2
===source===
<?php
final readonly class Money {
    public function __construct(
        public int $amount,
        public string $currency,
    ) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Money",
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "amount",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 83,
                              "end": 86,
                              "start_line": 4,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 83,
                          "end": 86,
                          "start_line": 4,
                          "start_col": 15
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 76,
                        "end": 94,
                        "start_line": 4,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "currency",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 111,
                              "end": 117,
                              "start_line": 5,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 111,
                          "end": 117,
                          "start_line": 5,
                          "start_col": 15
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 104,
                        "end": 127,
                        "start_line": 5,
                        "start_col": 8
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 39,
                "end": 138,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 21,
        "end": 139,
        "start_line": 2,
        "start_col": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 139,
    "start_line": 1,
    "start_col": 0
  }
}
