===source===
<?php interface static {}
===errors===
cannot use 'static' as interface name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "static",
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
