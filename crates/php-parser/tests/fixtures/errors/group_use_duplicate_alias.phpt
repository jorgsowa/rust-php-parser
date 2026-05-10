===source===
<?php use A\{B as Foo, C as Foo};
===errors===
cannot import A\C as Foo because the name is already in use
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
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 14
                }
              },
              "alias": "Foo",
              "span": {
                "start": 13,
                "end": 21
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "C"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 24
                }
              },
              "alias": "Foo",
              "span": {
                "start": 23,
                "end": 31
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
===php_error===
PHP Fatal error:  Cannot use A\C as Foo because the name is already in use in Standard input code on line 1
