===source===
<?php use A\{Foo, Foo};
===errors===
cannot import A\Foo as Foo because the name is already in use
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "Foo"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 16
                }
              },
              "alias": null,
              "span": {
                "start": 13,
                "end": 16
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "Foo"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 21
                }
              },
              "alias": null,
              "span": {
                "start": 18,
                "end": 21
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
===php_error===
PHP Fatal error:  Cannot use A\Foo as Foo because the name is already in use in Standard input code on line 1
